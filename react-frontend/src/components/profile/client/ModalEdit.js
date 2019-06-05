import React from 'react';
import Modal from 'react-bootstrap/Modal';
// import Button from 'react-bootstrap/Button';
import FormEdit from './FormEdit'

export default class ModalEdit extends React.Component {

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
           Редактирование профиля
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <FormEdit profile={this.props.profile}/>
        </Modal.Body>
      </Modal>
    );
  }
}