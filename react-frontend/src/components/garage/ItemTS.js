import React from 'react';
import PropTypes from 'prop-types';

export default class ItemTS extends React.Component {
  render () {
    let onButtonClick = (e) => {
      this.props.showModal(this.props.dataKey);
    };

    let TS = this.props.TS;

    return (
      <div>
        <p><b>Марка ТС:</b> {TS.car_model.name}</p>
        <p><b>ГосНОМЕР:</b> {TS.reg_number}</p>
        <p><b>Год производства:</b> {TS.rel_year}</p>
        <button className="btn-info" onClick={onButtonClick}>Редактировать</button>
      </div>
    )
  }
}

ItemTS.propTypes = {
  TS: PropTypes.object.isRequired
};