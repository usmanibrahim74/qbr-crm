export default {
  data() {
    return {
      BaseUrl: window.location.origin,
      PublicUrl: window.location.origin+"/public",
      AssetUrl: window.location.origin+"/public/dist/",

    }
  },
  methods:{
    getAssetPath(asset){
      return this.AssetUrl + asset;
    }
  }
}
