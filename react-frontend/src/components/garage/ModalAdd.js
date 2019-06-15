import React from 'react';
import Modal from 'react-bootstrap/Modal';
// import Button from 'react-bootstrap/Button';
import FormAddContainer from './FormAddContainer'

export default class ModalAdd extends React.Component {

  render() {
    return (
      <Modal
        show = {this.props.show}
        onHide = {this.props.onHide}
        size="lg"
        aria-labelledby="contained-modal-title-vcenter"
        centered
      >
        <Modal.Header closeButton>
          <Modal.Title id="contained-modal-title-vcenter">
           Добавить автомобиль
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <FormAddContainer onHide = {this.props.onHide}/>
        </Modal.Body>
      </Modal>
    );
  }
}