<template>
  <md-card class="md-theme-default">
    <md-card-actions>
      <div class="md-subhead">
        <span>HLS Live / 直播</span>
      </div>
      <md-button class="md-icon-button"
                 target="_blank"
                 title="code"
                 href="https://github.com/surmon-china/vue-video-player/tree/master/examples/04-video.vue">
          <md-icon><i class="fa fa-code"></i></md-icon>
      </md-button>
    </md-card-actions>
    <md-card-media>
      <div class="item">
        <div class="player">
          <video-player class="vjs-custom-skin" 
                        :options="playerOptions" 
                        @ready="playerReadied">
          </video-player>
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
        playerOptions: {
          // videojs and plugin options
          height: '360',
          language: 'ru',
          sources: [{
            withCredentials: false,
            type: "application/x-mpegURL",
//            src: "https://logos-channel.scaleengine.net/logos-channel/live/biblescreen-ad-free/playlist.m3u8" // Live
//            src: "http://givik.ru/assets/m/unicast-playlist.m3u" // no
//            src: "http://sample.vodobox.net/skate_phantom_flex_4k/skate_phantom_flex_4k.m3u8" // 2:21
            src: "http://rtmp.api.rt.com/hls/rtdru.m3u8" // RT Doc live
//            src: "http://online.video.rbc.ru/online/rbctv_480p/index.m3u8" // RBC live
//               src: "http://stream.kuvalda.tv/hls/5kanal.m3u8"

//          type: "video/mp4",
//          src: "http://vjs.zencdn.net/v/oceans.mp4"
          }],
          controlBar: {
            timeDivider: false,
            durationDisplay: false
          },
          flash: { hls: { withCredentials: false }},
          html5: { hls: { withCredentials: false }},
//          poster: "https://surmon-china.github.io/vue-quill-editor/static/images/surmon-5.jpg"
            poster: "https://givik.ru/assets/img/post/p12.jpg" //photo_7830_20081101.jpg"
        }
      };
    },
    methods: {
      playerReadied(player) {
        var hls = player.tech({ IWillNotUseThisInPlugins: true }).hls;
        player.tech_.hls.xhr.beforeRequest = function(options) {
          // console.log(options)
          return options;
        };
      }
    }
}

</script>
