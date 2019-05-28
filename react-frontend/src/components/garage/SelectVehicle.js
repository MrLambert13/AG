import React from 'react';
import PropTypes from 'prop-types';

export default class SelectVehicle extends React.Component {

  onSelectChange = (e) => {
    const select = document.getElementById("idSelect");
    let selectedId = select.options[select.selectedIndex].value;

    for (let vehicle of this.props.TS) {

      if (vehicle.id === +selectedId) {
        document.getElementById("new-name").value = vehicle.name;
        document.getElementById("new-number").value = vehicle.number;
        document.getElementById("new-year").value = vehicle.year;
      }
    }
  }

  render () {
    console.log();

    let options = this.props.TS.map(function (vehicle) {
      return (
        <option value={vehicle.id} key={vehicle.id}>{vehicle.id}</option>
      )
    });
    return (
      <select name="idSelect" id="idSelect" onChange={this.onSelectChange}>
        {options}
      </select>
    )
  }
}

SelectVehicle.propTypes = {
  TS: PropTypes.array.isRequired
};