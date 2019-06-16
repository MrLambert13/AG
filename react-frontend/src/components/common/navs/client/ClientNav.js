import React from 'react';
import './ClientNav.scss';
import {Nav, Navbar, Image, Form, Button} from 'react-bootstrap';
import logo from 'assets/bootstrap-solid.svg';
import {logout} from "actions/client/UserActions";
import {push} from "connected-react-router";
import {connect} from "react-redux";

class ClientNav extends React.Component {

  onClickHandler = (e) => {
    this.props.logout('/logout', {email: this.props.user.payload ? this.props.user.payload.email : null});
    this.props.redirect();
  };

  render() {
    return (
      <Navbar bg="dark" variant="dark" className="main-nav">
        <Navbar.Brand href="/"><Image src={logo} alt="logo" className="main-nav__logo" rounded/></Navbar.Brand>
        <Nav className="mr-auto">
          <Nav.Link href="/client/cabinet">Кабинет</Nav.Link>
          <Nav.Link href="/client/cabinet/request">Мои заказы</Nav.Link>
          <Nav.Link href="/client/cabinet/profile">Профиль</Nav.Link>
          <Nav.Link href="/client/cabinet/garage">Гараж</Nav.Link>
          <Nav.Link href="/client/cabinet/cart">Корзина</Nav.Link>
        </Nav>
        <Form inline>
          <Button variant="outline-info" onClick={this.onClickHandler}>Выйти</Button>
        </Form>
      </Navbar>
    )
  }
}

const mapStateToProps = store => {
  return {
    user: store.user,
  }
};

const mapDispatchToProps = dispatch => {
  return {
    logout: (url, data) => dispatch(logout(url, data)),
    redirect: () => dispatch(push('/')),
  }
};

export default connect(
  mapStateToProps,
  mapDispatchToProps,
)(ClientNav)