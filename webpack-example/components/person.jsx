var React = require('react');

var Person = React.createClass({

    getInitialState: function () {
        return {
            firstName: this.props.firstName
        };
    },

    handleKeyPress: function (e) {
        this.setState({
            firstName: e.target.value
        });
    },

    render: function() {
        return (
            <div>
                <label>First name:
                  <input onKeyUp={this.handleKeyPress} name="name" placeholder="Enter name" />
                </label>
                <p>{this.state.firstName} {this.props.lastName}</p>
            </div>
        );
    }
});

module.exports = Person;
