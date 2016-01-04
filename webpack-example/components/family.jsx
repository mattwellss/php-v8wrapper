import PeopleList from './people.jsx';
import React from 'react';

function getFamilyMembers(people, lastName) {
    return people.map(function (person) {
        return {
            firstName: person.firstName,
            lastName: lastName
        }
    });
}

export default class Family extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            people: getFamilyMembers(props.people, props.lastName)
        };
    }

    handleKeyUp(e) {
        this.setState({
            people: getFamilyMembers(this.state.people, e.target.value)
        });
    }

    render() {
        return (
            <div>
              <PeopleList people={this.state.people} />
              <div>
                <label>Last name:
                  <input onKeyUp={this.handleKeyUp.bind(this)} placeholder="Change last name" />
                </label>
              </div>
            </div>
          );
    }
}
