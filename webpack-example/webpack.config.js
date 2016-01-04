var webpack = require('webpack');
var entryOutput = JSON.parse(
    require('fs').readFileSync('entry-output.json'));

module.exports = {
    entry: entryOutput.entry,
    output: entryOutput.output,
    module: {
        loaders: [{
            test: /\.jsx?$/,
            exclude: /(node_modules|bower_components)/,
            loader: 'babel',
            query: {
                presets: ['react', 'es2015']
            }
        }],
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin('components', 'components.build.js')
        ,
        new webpack.optimize.UglifyJsPlugin()
        // ,
        // new webpack.SourceMapDevToolPlugin()
    ]
}
