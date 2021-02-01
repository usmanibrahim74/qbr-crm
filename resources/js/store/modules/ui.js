
// state
import * as types from "../mutation-types";

export const state = {
  loaded: false,
  theme:"light",

}

// getters
export const getters = {
  loaded: state => state.loaded,
  theme: state => {
    let theme = localStorage.getItem('theme')
    if(typeof (theme)== "undefined"){
      document.body.classList.add(state.theme+"-theme");
      return state.theme;
    }else{
      state.theme = theme;
      return theme;
    }
  },
}

// mutations
export const mutations = {
  pageLoaded (state) {
    state.loaded = true
  },

  toggleTheme (state) {
    document.body.classList.remove(state.theme+"-theme");
    if(state.theme == "light"){
      state.theme = "dark";
    }else{
      state.theme = "light";
    }
    document.body.classList.add(state.theme+"-theme");
    localStorage.setItem('theme',state.theme);
  },

}

export const actions = {
  loaded ({ commit }) {
    console.log('mounted')

    commit('pageLoaded')
  }
}
