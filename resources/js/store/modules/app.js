
// state
import * as types from "../mutation-types";
import axios from "axios";
import {Form} from "vform/src";
import _ from 'lodash'

export const state = {
  groups: [],
  reports: [],
  customers: [],
  risks: [],
  customer:null,
  report:null,
  summary:"",
  theme:"light",

}

// getters
export const getters = {

  groups: state => state.groups,
  customers: state => state.customers,
  reports: state => state.reports,
  report: state => state.report,
  customer: state => state.customer,
  risks: state => state.risks,
  summary: state => state.summary,
  group_items_count: state => {
    let total = 0;
    state.groups.forEach(function (group) {
      if(group.items)
      total += group.items.length;
    })
    return total;

  },

}

// mutations
export const mutations = {

  FETCH_GROUPS_SUCCESS(state,data){
    state.groups = data.groups;
  },

  FETCH_REPORT_SUCCESS(state,data){
    state.report = data.report;
  },

  FETCH_REPORTS_SUCCESS(state,data){
    state.reports = data.reports;
  },

  FETCH_CUSTOMERS_SUCCESS(state,data){
    state.customers = data.customers;
  },
  FETCH_CUSTOMER_SUCCESS(state,data){
    state.customer = data.customer;
  },
  FETCH_RISKS_SUCCESS(state,data){
    state.risks = data.risks;
  },
  FETCH_SUMMARY_SUCCESS(state,data){
    state.summary = data.summary;
  },


  ADD_GROUP(state,group){

    state.groups.push(group)
  },
  UPDATE_GROUP(state,data){
    let group = state.groups.find((group)=>{
      return group.id == data.id;
    });

    Object.assign(group,data.group);
  },

  DELETE_GROUP(state,data){
    let index = state.groups.indexOf(data.group);
    if(index>=0){
      state.groups.splice(index, 1);
    }
  },

  ADD_GROUP_ITEM(state,data){
    let group = state.groups.find((group)=>{
      return group.id == data.group_id;
    });
    group.items.push(data)
  },

  UPDATE_GROUP_ITEM(state,item){
    let group = state.groups.find((group)=>{
      return group.id == item.group_id;
    });
    let itemState = group.items.find((it)=>{
      return it.id == item.id;
    })
    Object.assign(itemState,item);
  },

  DELETE_GROUP_ITEM(state, {item}){
    let group = state.groups.find((group)=>{
      return group.id == item.group_id;
    });

    let index = group.items.indexOf(item);
    if(index>=0){
      group.items.splice(index, 1);
    }

  },

  UPDATE_REPORT_ITEM(state, item){
    let groupIndex = item.groupIndex;
    let itemIndex = item.itemIndex;
    delete item.groupIndex
    delete item.itemIndex;
    _.set(state.report,`groups[${groupIndex}].report_items[${itemIndex}]`,item);
  },

  UPDATE_REPORT(state, report){
    state.report = report;
  }

}

export const actions = {
  async fetchGroupsWithItems({commit}){
    const form = new Form({
      withItems: true,
    })
    const { data } = await form.post(`/api/groups`)
    commit('FETCH_GROUPS_SUCCESS',{groups:data});
  },
  async fetchGroups({commit}){
    const form = new Form({
      withItem: false,
    })
    const { data } = await form.post(`/api/groups`)
    commit('FETCH_GROUPS_SUCCESS',{groups:data});
  },
  async fetchReports({commit}){
    const { data } = await axios.get(`/api/reports`)
    commit('FETCH_REPORTS_SUCCESS',{reports:data});
  },
  async fetchReport({commit}, payload){
    const { data } = await axios.get(`/api/report/${payload.id}`)
    commit('FETCH_REPORT_SUCCESS',{report:data});
  },

  async fetchCustomers({commit}){
    const { data } = await axios.get(`/api/customers`)
    commit('FETCH_CUSTOMERS_SUCCESS',{customers:data});
  },
  async fetchCustomer({commit}, payload){
    const { data } = await axios.get(`/api/customer/${payload.id}`)
    commit('FETCH_CUSTOMER_SUCCESS',{customer:data});
  },
  async fetchRisks({commit}, payload){
    const { data } = await axios.get(`/api/risks`)
    commit('FETCH_RISKS_SUCCESS',{risks:data});
  },
  async fetchSummary({commit}, payload){
    const { data } = await axios.get(`/api/settings/summary`)
    commit('FETCH_SUMMARY_SUCCESS',{summary:data.summary});
  },

  save ({ commit }, data) {
    let action = data.action;
    delete data.action;
    commit(action,data);
  }
}
