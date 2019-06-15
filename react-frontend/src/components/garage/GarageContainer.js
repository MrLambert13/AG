import React from 'react';
import {connect} from 'react-redux';
import { getTS, setTS, updateTS} from 'actions/client/GarageActions'
import ListTS from './ListTS';
import ModalEdit from './ModalEdit';
import ModalAdd from './ModalAdd';
import {Button} from 'react-bootstrap';

class GarageContainer extends React.Component {

  state = {
    modalEditShow: false,
    modalAddShow: false,
    currentItemKey: '',
  };

  componentDidMount() {
    this.props.getTS('/api/vehicle');
  }

  render() {

    let modalEditClose = () => this.setState({ modalEditShow: false });
    let modalAddClose = () => this.setState({ modalAddShow: false });
    let modalEditShow = (key) => this.setState({ modalEditShow: true,  currentItemKey: key});

    const { garage } = this.props;

    let currentItem = garage.TS.find((item) => (+item.id === +this.state.currentItemKey));
    let filteredItems = garage.TS.filter( (item) => (+item.created_by === this.props.user.id_user));

    return (
      <div className="app">
        <h4>Список Ваших автомобилей:</h4>
        <ListTS TS={filteredItems} showModal={modalEditShow}/>
        <div className="d-flex justify-content-around">
          <Button className="btn btn-danger" onClick={() => {this.setState({ modalAddShow: true })}}>Добавить машину</Button>
        </div>
        <ModalEdit
          show={this.state.modalEditShow}
          onHide={modalEditClose}
          vehicle={currentItem}
          currentItemKey={this.state.currentItemKey}
        />
        <ModalAdd
          show={this.state.modalAddShow}
          onHide={modalAddClose}
        />
      </div>
    )
  }
}


const mapStateToProps = store => {
  return {
    garage: store.garage,
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    // createGarage: (url, data) => dispatch(createGarage(url, data)),
    getTS: url => dispatch(getTS(url)),
    setTS: (url, data) => dispatch(setTS(url, data)),
    updateTS: (url, data) => dispatch(updateTS(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(GarageContainer)
