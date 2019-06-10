import React from 'react';
import classNames from 'classnames';
import AutocompleteBox from './AutocompleteBox';
import './AutocompleteInput.scss';
import OutsideHandler from 'components/common/handler/OutsideHandler';

export default class AutocompleteInput extends React.Component {

  items = this.props.items;

  state = {
    filteredItems: [],
    currentInputValue: ''
  };

  onInputHandle = (e) => {
    e.preventDefault();

    const string = e.target.value;
    const regExp = new RegExp('^' + string, 'i');

    if (string.length <= 2) {

      this.setState({
        filteredItems: []
      });

      return null;
    }

    let filteredItems = this.items.filter(item => regExp.test(item.name));

    this.setState({ filteredItems });
  };

  onItemClickHandle = (e) => {
    e.preventDefault();

    if (e.target.classList.contains('autocomplete-box__item')) {
      this.setState({
        filteredItems: [],
        currentInputValue: e.target.innerHTML
      });
    }
  };

  outsideClickHandler = (e) => {
    this.setState({
      filteredItems: []
    });
  };

  render() {

    return (
      <OutsideHandler clickHandler={this.outsideClickHandler}>
        <div onClick={this.onItemClickHandle}>
          <label htmlFor="autocompleteInput">На всякий случай реализован автокомплит, но не примонтирован к данным</label>
          <input
            type="text"
            placeholder="Autocomplete"
            id="autocompleteInput"
            className={classNames('form-control', 'mt-1', 'col-3')}
            onInput={this.onInputHandle}
            onChange={(e) => {this.setState({ currentInputValue: e.target.value})}}
            value={this.state.currentInputValue}
          />
          <AutocompleteBox items={this.state.filteredItems}/>
        </div>
      </OutsideHandler>
    )
  }
}