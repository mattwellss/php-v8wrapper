import React from 'react';
import Person from './person.jsx';

export default class PeopleList extends React.Component {

    render() {
        let peopleList = this.props.people.map(function (person) {
            return (
                <li><Person key={person.key} firstName={person.firstName} lastName={person.lastName} /></li>
            );
        });
        return peopleList.length > 0?
            <ul>{peopleList}</ul>:
            <div>No results!</div>
    }
}

PeopleList.defaultProps = { people: [] };
