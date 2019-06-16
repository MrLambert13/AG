import React from 'react';
import {connect} from 'react-redux';
import { getOrder } from 'actions/client/OrderActions'
import ModalAdd from './ModalAdd';
import {Button} from 'react-bootstrap';
import {Tab, Row, Col, Nav} from 'react-bootstrap'

class OrderContainer extends React.Component {

  state = {
    modalAddShow: false,
  };

  componentDidMount() {
    // Тут получаем список текущих заказов
    this.props.getOrder('/order/index', {idUser: this.props.user.id_user});
  }

  render() {

    let modalAddClose = () => this.setState({ modalAddShow: false });

    const { order } = this.props;

    return (
      <div className="app">
        <h4>Список заказов:</h4>
        <div className="d-flex justify-content-around">
          <Button className="btn btn-danger" onClick={() => {this.setState({ modalAddShow: true })}}>Добавить заказ</Button>
        </div>
        <ModalAdd
          show={this.state.modalAddShow}
          onHide={modalAddClose}
        />
        <Tab.Container id="left-tabs-example" defaultActiveKey="first">
          <Row>
            <Col sm={3}>
              <Nav variant="pills" className="flex-column">
                <Nav.Item>
                  <b>Поиск исполнителя</b>
                  <Nav.Link eventKey="first">Tab 1</Nav.Link>
                </Nav.Item>
                <Nav.Item>
                  <b>В  работе</b>
                  <Nav.Link eventKey="second">Tab 2</Nav.Link>
                </Nav.Item>
                <Nav.Item>
                  <b>Завершенные</b>
                  <Nav.Link eventKey="third">Tab 3</Nav.Link>
                </Nav.Item>
              </Nav>
            </Col>
            <Col sm={9}>
              <Tab.Content>
                <Tab.Pane eventKey="first">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusamus culpa cupiditate dignissimos distinctio ducimus, est facere in inventore laborum maxime molestias necessitatibus non, nostrum officiis possimus quia sed voluptatem! Aut beatae commodi distinctio error excepturi facilis ipsam ipsum, iste iusto maiores neque obcaecati odit possimus quos ratione recusandae voluptatum.</p>
                </Tab.Pane>
                <Tab.Pane eventKey="second">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam corporis, delectus dolorem dolorum eveniet exercitationem incidunt, laboriosam maxime minus nulla pariatur, possimus qui quidem repellat repudiandae sunt tempore temporibus. Accusamus exercitationem fugit hic itaque nostrum officia optio saepe sequi. Autem dignissimos ducimus earum enim exercitationem iusto pariatur recusandae saepe, veritatis?</p>
                </Tab.Pane>
                <Tab.Pane eventKey="third">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam corporis, delectus dolorem dolorum eveniet exercitationem incidunt, laboriosam maxime minus nulla pariatur, possimus qui quidem repellat repudiandae sunt tempore temporibus. Accusamus exercitationem fugit hic itaque nostrum officia optio saepe sequi. Autem dignissimos ducimus earum enim exercitationem iusto pariatur recusandae saepe, veritatis?</p>
                </Tab.Pane>
              </Tab.Content>
            </Col>
          </Row>
        </Tab.Container>
      </div>
    )
  }
}


const mapStateToProps = store => {
  return {
    order: store.order,
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    getOrder: (url, data) => dispatch(getOrder(url, data)),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps
)(OrderContainer)
