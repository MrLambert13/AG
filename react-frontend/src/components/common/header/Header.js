import React from 'react';
import './Header.scss';
import Nav from 'react-bootstrap/Nav';

const Header = () => {
  return (
    <header>
      <Nav
        activeKey="/home"
        onSelect={selectedKey => alert(`selected ${selectedKey}`)}
        className="main-nav justify-content-center align-items-center"
      >
        <Nav.Item className="main-nav__item">
          <Nav.Link href="/home">Active</Nav.Link>
        </Nav.Item>
        <Nav.Item className="main-nav__item">
          <Nav.Link href="/home1" eventKey="link-1">Link</Nav.Link>
        </Nav.Item>
        <Nav.Item className="main-nav__item">
          <Nav.Link href="/home2" eventKey="link-2">Link</Nav.Link>
        </Nav.Item>
        <Nav.Item>
          <Nav.Link eventKey="disabled" disabled>
            Disabled
          </Nav.Link>
        </Nav.Item>
      </Nav>
    </header>
  )
};

export default Header