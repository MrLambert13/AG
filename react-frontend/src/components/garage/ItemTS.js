import React from 'react';
import PropTypes from 'prop-types';
import ListTS from "./ListTS";

export default class ItemTS extends React.Component {
  render () {
    let TS = this.props.TS;

    return (
      <div>
        <p><b>Марка ТС:</b> {TS.name}</p>
        <p><b>ГосНОМЕР:</b> {TS.number}</p>
        <p><b>Год производства:</b> {TS.year}</p>
      </div>
    )
  }
}

ItemTS.propTypes = {
  TS: PropTypes.object.isRequired
};