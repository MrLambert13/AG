import React from 'react';
import Modal from 'react-bootstrap/Modal';
// import Button from 'react-bootstrap/Button';
import FormEditContainer from './FormEditContainer'

export default class ModalEdit extends React.Component {

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
           Редактирование профиля
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <FormEditContainer onHide = {this.props.onHide}/>
        </Modal.Body>
      </Modal>
    );
  }
}