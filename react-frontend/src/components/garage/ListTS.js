import React from 'react';
import PropTypes from 'prop-types';
import ItemTS from './ItemTS';

export default class ListTS extends React.Component {
  render() {
    const listTemplate = this.props.TS.map(function(TS) {
      return (
        <ItemTS TS={TS} key={TS.id} />
      )
    });

    return (
      <div className="List">{listTemplate}</div>
    )
  }
}

ListTS.propTypes = {
  TS: PropTypes.array.isRequired
};