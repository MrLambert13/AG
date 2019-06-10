import React from 'react';

export default class AutocompleteBox extends React.Component {

  render() {

    const itemsList = this.props.items.map(function(item) {

      return (
        <div className="autocomplete-box__item" key={item.id}>
          {item.name}
        </div>
      )
    });

    return (
      <div className="autocomplete-box">
        {itemsList}
      </div>
    );

  }
}