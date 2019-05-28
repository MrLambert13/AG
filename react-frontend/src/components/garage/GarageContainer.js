import React from 'react';
import {connect} from 'react-redux';
import {getTS, setTS, updateTS} from '../../actions/client/GarageActions'
import ListTS from './ListTS';
import SelectVehicle from './SelectVehicle';

class GarageContainer extends React.Component {

  onBtnClickHandler = (e) => {
    e.preventDefault();

    let data = {
      name: document.getElementById("name").value,
      number: document.getElementById("number").value,
      year: document.getElementById("year").value,
  };
    // console.log(data);
    this.props.setTS("http://localhost:3004/TS", data);
  };

  onBtnUpdateClickHandler = (e) => {
    e.preventDefault();

    let data = {
      name: document.getElementById("new-name").value,
      number: document.getElementById("new-number").value,
      year: document.getElementById("new-year").value,
    };

    const select = document.getElementById("idSelect");
    let selectedId = select.options[select.selectedIndex].value;

    this.props.updateTS("http://localhost:3004/TS/" + selectedId, data);
  };


  componentDidMount() {
    this.props.getTS('http://localhost:3004/TS');
  }

  render() {

    return (
      <div className="app">
        <h3>Добро пожаловать в гараж</h3>

        {/*<button onClick={this.onBtnClickHandler}>Вывести список ТС</button>*/}
        <h4>Список Ваших автомобилей:</h4>
        <ListTS TS={this.props.TS}/>
        <h4>Вы можете добавить авто</h4>
        <form action="">
          <input type="text" id="name" placeholder="Марка автомобиля" required={true}/>
          <input type="text" id="number" placeholder="ГосНомер" required={true}/>
          <input type="text" id="year" placeholder="Код производства"/>
          <button type="submit" onClick={this.onBtnClickHandler}>Добавить</button>
        </form>
        <h4>Вы можете отредактировать ТС для выбранного ID</h4>
        <b>ID автомобиля</b><SelectVehicle TS={this.props.TS}/>
        <form action="">
          <input type="text" id="new-name" placeholder="Марка автомобиля" required={true}/>
          <input type="text" id="new-number" placeholder="ГосНомер" required={true}/>
          <input type="text" id="new-year" placeholder="Код производства"/>
          <button type="submit" onClick={this.onBtnUpdateClickHandler}>Изменить</button>
        </form>
      </div>
    )
  }
}

const mapStateToProps = store => {
  return {
    TS: store.garage.TS,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getTS: url => dispatch(getTS(url)),
    setTS: (url, data) => dispatch(setTS(url, data)),
    updateTS: (url, data) => dispatch(updateTS(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(GarageContainer)
