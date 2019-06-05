import React from 'react';
import Nav from 'components/common/navs/client';
import Footer from 'components/common/footer';

const Main = (props) => (
  <React.Fragment>
    <Nav/>
    {props.children}
    <Footer/>
  </React.Fragment>
);

export default Main