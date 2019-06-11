import React from 'react';
import './ClientNav.scss';
import {Nav, Navbar, Image} from 'react-bootstrap';
import logo from 'assets/bootstrap-solid.svg';

const ClientNav = () => {
  return (
    <Navbar bg="dark" variant="dark" className="main-nav">
      <Navbar.Brand href="/"><Image src={logo} alt="logo" className="main-nav__logo" rounded /></Navbar.Brand>
      <Nav className="mr-auto">
        <Nav.Link href="/client/cabinet">Кабинет</Nav.Link>
        <Nav.Link href="/client/cabinet/profile">Профиль</Nav.Link>
        <Nav.Link href="/client/cabinet/garage">Гараж</Nav.Link>
      </Nav>
    </Navbar>
  )
};

export default ClientNav