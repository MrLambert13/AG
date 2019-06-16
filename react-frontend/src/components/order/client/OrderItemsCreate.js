import React from 'react';
import {Tab, Row, Col, Nav} from 'react-bootstrap';

export default class OrderItemsCreate extends React.Component {

  render() {
    const navItemsTemplate = this.props.items.map((item) => {
      return (
        <Nav.Item key={item.id}>
          <Nav.Link eventKey={item.id}>Заказ №{item.id}</Nav.Link>
        </Nav.Item>
      )
    });

    const tabItemsTemplate = this.props.items.map((item) => {
      return (
        <Tab.Pane eventKey={item.id} key={item.id}>
          <p>Заказ №{item.id}. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores cum doloribus porro repellendus voluptatum? Accusamus amet architecto, blanditiis deleniti dignissimos et fugiat minus, officia optio quam saepe veniam voluptas voluptate.</p>
        </Tab.Pane>
      )
    });

    return (
      <Tab.Container id="order-items-create" defaultActiveKey={this.props.items.length ? this.props.items[0].id : ''}>
        <h3>Поиск исполнителя</h3>
        <Row>
          <Col sm={3}>
            <Nav variant="pills" className="flex-column">
              {navItemsTemplate}
            </Nav>
          </Col>
          <Col sm={9}>
            <Tab.Content>
              {tabItemsTemplate}
            </Tab.Content>
          </Col>
        </Row>
      </Tab.Container>
    )
  }
}
