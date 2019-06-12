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

    const listTemplate = this.props.stoItems.map(function(sto) {
      return (
        <div className="card">
          <div className="wrap-left">
            <div className="name-sto">{sto.name}</div>
            <div className="">22 отзыва</div>
            <div className="">Диагностика подвески <span>от 600</span>руб.</div>
            <div className="">Замена фильтра <span>от 450</span>руб.</div>
          </div>
          <div className="wrap-right">
            <div className="distance-sto">{sto.geo}</div>
            <div className="">пн-вс: с 07:30 до 23:00</div>
            <div className="">Сейчас открыто</div>
            <i>{sto.telephone}</i>
          </div>
        </div>
      )
    });

    return (
      <div className="content-find-map">
        <div className="text">Цены будут точнее, если вы также укажете:</div>
        <div className="drop-down-filters d-flex justify-content-start w-100">
          <ScrollDropdown title="Год выпуска" className="year" items={yearItems} onClickHandler={this.onDropdownClickHandler} propKey="yearId"/>
          <ScrollDropdown title="КПП" className="transmission" items={transmissionItems} onClickHandler={this.onDropdownClickHandler} propKey="transmissionId"/>
          <ScrollDropdown title="Пробег" className="run" items={mileageItems} onClickHandler={this.onDropdownClickHandler} propKey="mileageId"/>
          <ScrollDropdown title="Город" className="city" items={cityItems} onClickHandler={this.onDropdownClickHandler} propKey="cityId"/>
          <ScrollDropdown title="Район" className="distikt" items={districtItems} onClickHandler={this.onDropdownClickHandler} propKey="districtId"/>
          <ScrollDropdown title="Метро" className="distikt" items={subwayItems} onClickHandler={this.onDropdownClickHandler} propKey="subwayId"/>
          <input type="date" className="date" onChange={this.onDateChangeHandler} defaultValue={this.state.date.toISOString().substr(0, 10)} min={this.state.date.toISOString().substr(0, 10)}/>
          <ScrollDropdown title="Время" className="time" items={timeItems} onClickHandler={this.onDropdownClickHandler} propKey="timeId"/>
        </div>
        <div>
          <div className="wrap-cards-map">
            <div className="wrap-cards">
              <div className="wrap-text-on-cards">
                <div>Найдено {this.props.stoItems.length} сервиса</div>
                <div>
                  <select className="sort-distance">
                    <option>по удаленности</option>
                  </select>
                </div>
              </div>

              <div className="d-flex flex-column">
                {listTemplate}
              </div>

            </div>
            <div className="map">
              <iframe
                src="https://yandex.ru/map-widget/v1/?um=constructor%3A4d471f55c25653c1b74bc91fb82024e7c63f9bdc94590692494ea679bd032b67&amp;source=constructor"
                width="549" height="373" frameBorder="0"></iframe>
            </div>
          </div>
        </div>
      </div>
    )
  }
}


