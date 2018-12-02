<template>
    <md-card>
        <md-card-actions>
          <div class="md-subhead">
            <span>Base Config / 基本示例</span>
          </div>
          <md-button class="md-icon-button"
                     target="_blank"
                     title="code"
                     href="https://github.com/surmon-china/vue-video-player/tree/master/examples/01-video.vue">
              <md-icon><i class="fa fa-code"></i></md-icon>
          </md-button>
        </md-card-actions>
        <md-card-media>
            <div class="item">
                <div class="player">
                  <video-player  class="vjs-custom-skin"
                                 ref="videoPlayer"
                                 :options="playerOptions"
                                 :playsinline="true"
                                 @play="onPlayerPlay($event)"
                                 @pause="onPlayerPause($event)"
                                 @ended="onPlayerEnded($event)"
                                 @loadeddata="onPlayerLoadeddata($event)"
                                 @waiting="onPlayerWaiting($event)"
                                 @playing="onPlayerPlaying($event)"
                                 @timeupdate="onPlayerTimeupdate($event)"
                                 @canplay="onPlayerCanplay($event)"
                                 @canplaythrough="onPlayerCanplaythrough($event)"
                                 @ready="playerReadied"
                                 @statechanged="playerStateChanged($event)">
                  </video-player>
                </div>
            </div>
            <div class="row mb-5"> 
                <div class=" flex-container sendquery" >
                    <div class="fl-inner">
                        <div class="form-group srow">
                            <select class="form-control select" id="videoSrc" v-model="videoSource">
                                <option value="" selected disabled>Select source…</option>
                                <option v-for="option in selectOptions" :value="option">{{ option.descr }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="fl-inner">
                        <button @click="sendQuery" class="btn btn-small btn-dark-solid  btn-transparent sflex-element">Выбрать</button>
                    </div>
                </div>
            </div>
        </md-card-media>
    </md-card>
</template>

<script>
import { videoPlayer } from 'vue-video-player'
import 'vue-video-player/src/custom-theme.css'

// videojs
import videojs from 'video.js'
import 'video.js/dist/video-js.css'
window.videojs = videojs;

// hls plugin for videojs6
require('videojs-contrib-hls/dist/videojs-contrib-hls.js');

export default {
    components: {
        videoPlayer
    },
    data() {
      return {
        selectOptions: [
            {type: 'video/mp4',
             src: 'http://vjs.zencdn.net/v/oceans.mp4',
             descr: 'Ocean | 0:46',
             poster: 'https://givik.ru/assets/img/post/oceans.jpg'
            },
            {type: 'application/x-mpegURL',
             src: 'https://logos-channel.scaleengine.net/logos-channel/live/biblescreen-ad-free/playlist.m3u8',
             descr: 'BibleScreen | live',
             poster: 'https://givik.ru/assets/img/post/p12.jpg'
            },
            {type: 'application/x-mpegURL',
             src: 'http://rtmp.api.rt.com/hls/rtdru.m3u8',
             descr: 'RT Doc | live',
             poster: 'https://givik.ru/assets/img/post/p7.jpg'
            },
            {type: 'application/x-mpegURL',
             src: 'http://online.video.rbc.ru/online/rbctv_480p/index.m3u8',
             descr: 'RBC | live',
             poster: 'https://givik.ru/assets/img/post/p2.jpg'
            },
            {type: 'video/mp4',
             src: 'https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm',
             descr: 'thegardian.tv - YesMen | 10:53',
             poster: 'https://givik.ru/assets/img/post/p1.jpg'
            }
        ],
        videoSource: '',
        // videojs options
        playerOptions: {
          height: '448',
          autoplay: false,
          muted: true,
          language: 'en',
          playbackRates: [0.7, 1.0, 1.5, 2.0],
          sources: [{
            type: "video/mp4",
            // mp4
            src: "http://vjs.zencdn.net/v/oceans.mp4"
            // webm
//             src: "https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm"
            }],
//          poster: "https://surmon-china.github.io/vue-quill-editor/static/images/surmon-1.jpg",
            poster: "https://givik.ru/assets/img/post/oceans.jpg" 
        }
      };
    },
    mounted() {
//       console.log('this is current player instance object', this.player)
      setTimeout(() => {
//        console.log('dynamic change options', this.player);
        // change src
//         this.playerOptions.sources[0].src = 'https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm';
        // change item
        // this.$set(this.playerOptions.sources, 0, {
        //   type: "video/mp4",
        //   src: 'https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm',
        // })
        // change array
        // this.playerOptions.sources = [{
        //   type: "video/mp4",
        //   src: 'https://cdn.theguardian.tv/webM/2015/07/20/150716YesMen_synd_768k_vp8.webm',
        // }]
        this.player.muted(false);
      }, 5000);
    },
    computed: {
      player() {
        return this.$refs.videoPlayer.player;
      }
    },
    methods: {
      sendQuery() {
        console.log(this.videoSource.poster + ' -> ' + this.videoSource.type + ' -> ' + this.videoSource.src +  ' -> ' + this.videoSource.descr);
        this.playerOptions.sources = [{
           type: this.videoSource.type,
           src: this.videoSource.src
           
         }];
        this.playerOptions.poster = this.videoSource.poster;
         setTimeout(() => {
            this.player.muted(false); 
         }, 2000);
      },
      // listen event
      onPlayerPlay(player) {
//         console.log('player play!', player)
      },
      onPlayerPause(player) {
        // console.log('player pause!', player)
      },
      onPlayerEnded(player) {
        // console.log('player ended!', player)
      },
      onPlayerLoadeddata(player) {
        // console.log('player Loadeddata!', player)
      },
      onPlayerWaiting(player) {
        // console.log('player Waiting!', player)
      },
      onPlayerPlaying(player) {
        // console.log('player Playing!', player)
      },
      onPlayerTimeupdate(player) {
        // console.log('player Timeupdate!', player.currentTime())
      },
      onPlayerCanplay(player) {
        // console.log('player Canplay!', player)
      },
      onPlayerCanplaythrough(player) {
        // console.log('player Canplaythrough!', player)
      },
      // or listen state event
      playerStateChanged(playerCurrentState) {
        // console.log('player current update state', playerCurrentState)
      },
      // player is ready
      playerReadied(player) {
        // seek to 10s
//        console.log('example player 1 readied', player)
//        player.currentTime(10)
        // console.log('example 01: the player is readied', player)
      }
    }
  }

</script>

<style>
    #videoSrc {
        width: 25rem;
    }
    .sendquery {
        justify-content: center;
        align-items: center;
    }
    .fl-inner button {
            margin-top: -19px;
            padding-top: 8px;
            padding-bottom: 8px;
    }
    .fl-inner {
        margin-left: 10px;
        margin-top: 15px;
    }
</style>