import React from 'react';
import Modal from 'react-bootstrap/Modal';
import FormPassword from './FormPassword'

export default class ModalPassword extends React.Component {

  render() {
    return (
      <Modal
        {...this.props}
        size="lg"
        aria-labelledby="contained-modal-title-vcenter"
        centered
      >
        <Modal.Header closeButton>
          <Modal.Title id="contained-modal-title-vcenter">
           Изменить пароль
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <FormPassword/>
        </Modal.Body>
      </Modal>
    );
  }
}