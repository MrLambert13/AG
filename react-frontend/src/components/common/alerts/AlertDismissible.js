import React from 'react';
import Alert from 'react-bootstrap/Alert'
import Button from 'react-bootstrap/Button'

export default class AlertDismissible extends React.Component {

  render() {
    const handleHide = () => {
      this.props.onHide();
    };

    return (
      <Alert variant="success" show={this.props.show} onClose={handleHide} dismissible>
        <Alert.Heading>{this.props.headerText}</Alert.Heading>
        <p>{this.props.bodyText}</p>
        <hr/>
        <div className="d-flex justify-content-end">
          <Button onClick={handleHide} variant="outline-success">
            OK
          </Button>
        </div>
      </Alert>
    );
  }
}