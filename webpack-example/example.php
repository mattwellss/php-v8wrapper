<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

// Get the bundle configuration shared with webpack
$bundleConfig = json_decode(
    file_get_contents(__DIR__ . '/entry-output.json'));

// Webpack uses `window` as a global
$browserizer = new Mpw\V8\JsLib('browserizer', 'var window = {};');

// Here's the ES5-ish bundle that works with browsers and V8
$componentBundle = new Mpw\V8\JsLib(
    'components',
    file_get_contents(__DIR__ . '/components.build.js'));

// Ensure that the browserization happens before the component bundle execs
$componentBundle->addDep($browserizer);

// Wraps V8 for simplicity
$v8W = new Mpw\V8\V8Wrapper($componentBundle, $browserizer);

$componentFactory = new Mpw\V8\ReactComponentFactory(
    $v8W, $bundleConfig->output->library);

// Create a new component
$personComponentHtml = $componentFactory->renderComponent(
    'Person',
    [ 'firstName' => 'Matt' ]);

$peopleData = [
    'people' => [
        [ 'firstName' => 'Matt' ],
        [ 'firstName' => 'Paulie' ]
    ],
    'lastName' => 'Wells'
];
$peopleComponentHtml = $componentFactory->renderComponent(
    'Family', $peopleData);

// Add more data to people array to show frontend render
$peopleData['people'][] = ['firstName' => 'Zora'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server-side rendering</title>
</head>
<body>
<script>
<?= $componentBundle->getSrc(); ?>
</script>
<script>
(function (ReactDOM, React, Components) {
    document.addEventListener('DOMContentLoaded', function (e) {
        ReactDOM.render(
            React.createElement(Components.Family, <?= json_encode($peopleData) ?>),
            document.querySelector('#people'));

        ReactDOM.render(
            React.createElement(
                Components.Person, {
                    firstName: 'Matthew',
                    lastName: 'Test'
                }),
            document.querySelector('#justoneperson'));
    });
}(MR.ReactDOM, MR.React, MR.Components));
</script>
<div id="people"><?= $peopleComponentHtml ?></div>
<hr />
<div id="justoneperson"><?= $personComponentHtml ?></div>
</body>
</html>
