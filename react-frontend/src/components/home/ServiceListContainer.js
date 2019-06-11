import React from 'react';
import ScrollDropdown from 'components/common/dropdowns/scroll';
import {getBrand, getModel, getService} from "actions/all/HomeActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";
import Button from 'react-bootstrap/Button';

let yearItems = [{id: 1, name: '1990 - 2000'}, {id: 2, name: '2000 - 2010'}, {id: 3, name: '2010 - 2019'}];
let transmissionItems = [{id: 1, name: 'Автомат'}, {id: 2, name: 'Механика'}];
let mileageItems = [{id: 1, name: '0 - 1000'}, {id: 2, name: '1000 - 5000'}];
let cityItems = [{id: 1, name: 'Москва'}, {id: 2, name: 'Санкт-Петербург'}];
let districtItems = [{id: 1, name: 'САО'}, {id: 2, name: 'СЗАО'}];
let subwayItems = [{id: 1, name: 'Охотный ряд'}, {id: 2, name: 'Киевская'}];
let timeItems = [{id: 1, name: 'Утро'}, {id: 2, name: 'День'}, {id: 3, name: 'Вечер'}];

export default class ServiceListContainer extends React.Component {

  state = {
    yearId: null,
    transmissionId: null,
    mileageId: null,
    cityId: null,
    districtId: null,
    subwayId: null,
    date: new Date(),
    timeId: null
  };

  onDropdownClickHandler = (id, propKey) => {
    let obj = {};
    obj[propKey] = id;

    this.setState(obj);
  };

  onDateChangeHandler = (e) => {
    let date = new Date(e.target.value);

    this.setState({
      date
    });
  };

  render() {
    return (
      <div>
        <div className="d-flex justify-content-start w-100">
          <ScrollDropdown title="Год выпуска" items={yearItems} onClickHandler={this.onDropdownClickHandler} propKey="yearId"/>
          <ScrollDropdown title="КПП" items={transmissionItems} onClickHandler={this.onDropdownClickHandler} propKey="transmissionId"/>
          <ScrollDropdown title="Пробег" items={mileageItems} onClickHandler={this.onDropdownClickHandler} propKey="mileageId"/>
          <ScrollDropdown title="Город" items={cityItems} onClickHandler={this.onDropdownClickHandler} propKey="cityId"/>
          <ScrollDropdown title="Район" items={districtItems} onClickHandler={this.onDropdownClickHandler} propKey="districtId"/>
          <ScrollDropdown title="Метро" items={subwayItems} onClickHandler={this.onDropdownClickHandler} propKey="subwayId"/>
          <input type="date" onChange={this.onDateChangeHandler} defaultValue={this.state.date.toISOString().substr(0, 10)} min={this.state.date.toISOString().substr(0, 10)}/>
          <ScrollDropdown title="Время" items={timeItems} onClickHandler={this.onDropdownClickHandler} propKey="timeId"/>
        </div>
      </div>
    )
  }
}


