export default {
  data() {
    return {
      BaseUrl: window.location.origin,
      PublicUrl: window.location.origin+"/",
      AssetUrl: window.location.origin+"/dist/",

    }
  },
  methods:{
    getAssetPath(asset){
      return this.AssetUrl + asset;
    }
  }
}
