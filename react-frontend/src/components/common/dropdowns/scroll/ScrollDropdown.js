import React from 'react';
import './ScrollDropdown.scss';
import Dropdown from 'react-bootstrap/Dropdown'
import PropTypes from "prop-types";

export default class ScrollDropdown extends React.Component {

  state = {
    currentItem: {},
  };

  onItemClickHandler = (e) => {

    let currentItem = this.props.items.find((item) => (+item.id === +e.target.getAttribute('data-key')));

    this.setState({
      currentItem,
    });

    if (this.props.onClickHandler) {
      this.props.propKey ? this.props.onClickHandler(currentItem.id, this.props.propKey) : this.props.onClickHandler(currentItem.id);
    }
  };

  static getDerivedStateFromProps(nextProps, prevState) {
    if (nextProps.reset) {
      return {
        currentItem: {}
      }
    }

    return null;
  }

  render() {
    console.log(this.props.title + ' renders!');

    const itemsList = this.props.items.map((item) => {
      return (
        <Dropdown.Item as="button" onClick={this.onItemClickHandler} key={item.id}
                       data-key={item.id}>{item.name}</Dropdown.Item>
      )
    });

    return (
      <Dropdown className="mr-1">
        <Dropdown.Toggle variant="success" id="dropdown-basic">
          {this.state.currentItem.name ? this.state.currentItem.name : this.props.title}
        </Dropdown.Toggle>

        {
          this.props.items.length > 0 &&
          <Dropdown.Menu>
            {itemsList}
          </Dropdown.Menu>
        }

      </Dropdown>
    );

  }
}

ScrollDropdown.propTypes = {
  title: PropTypes.string.isRequired,
  items: PropTypes.array.isRequired,
  reset: PropTypes.bool,
  onClickHandler: PropTypes.func,
  propKey: PropTypes.string,
};