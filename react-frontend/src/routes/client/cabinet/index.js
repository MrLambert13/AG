import React from 'react';
import Main from 'components/common/layouts/client/main';

export default class Cabinet extends React.Component {
  render() {
    return (
      <Main>
        <h1>Тут будет список заказов:</h1>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
          <li>Consequatur cumque earum enim, officiis ratione reprehenderit.</li>
          <li>Ipsum libero mollitia nemo, nobis optio ullam.</li>
          <li>Ab adipisci aut eaque quam veritatis! Impedit!</li>
          <li>At doloribus mollitia necessitatibus quia quibusdam sed!</li>
          <li>Commodi, cumque dolorum id minima omnis sed.</li>
        </ul>
      </Main>
    )
  }
}
