<template>
<div class="wrap">
    <div class="row mb-3"> 
        <div class=" flex-container sendquery" >
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="ipAdres" class="bmd-label-floating">IP-адрес:</label>
                    <vue-ip class="form-control" :ip="ipAddress" :on-change="change" theme="material" id="ipAdres" v-model="ipAddress"></vue-ip>
                    <!-- <input type="text" class="form-control" id="ipAdres" v-model="ipAddress"> -->
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="networkMask" >Маска:</label>
                    <select class="form-control select" id="networkMask" v-model="bitMask">
                        <option v-for="option in options" :value="option.bit">{{ option.bit }} - {{ option.mask }}</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <button @click="sendQuery" class="btn btn-success flex-element">Подсчитать</button>
            </div>
        </div>
    </div>
    <!-- <div class="row">{{ data }}</div> -->

    <div class="row">
        <div class="col-sm-3">
            <span>Address:</span>
        </div>
        <div class="col-sm-3">
            <span>{{ip}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ ipbin.substr(0,8) + '.' + ipbin.substr(8,8) + '.' + ipbin.substr(16,8) + '.' + ipbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>Netmask:</span>
        </div>
        <div class="col-sm-3">
            <span>{{netmask + '&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp;&nbsp;' + bitMask}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ netmaskbin.substr(0,8) + '.' + netmaskbin.substr(8,8) + '.' + netmaskbin.substr(16,8) + '.' + netmaskbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>Wildcard:</span>
        </div>
        <div class="col-sm-3">
            <span>{{wildcard}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ wildcardbin.substr(0,8) + '.' + wildcardbin.substr(8,8) + '.' + wildcardbin.substr(16,8) + '.' + wildcardbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>Network:</span>
        </div>
        <div class="col-sm-3">
            <span>{{network + '/' + bitMask}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ networkbin.substr(0,8) + '.' + networkbin.substr(8,8) + '.' + networkbin.substr(16,8) + '.' + networkbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>Broadcast:</span>
        </div>
        <div class="col-sm-3">
            <span>{{broadcast}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>HostMin:</span>
        </div>
        <div class="col-sm-3">
            <span>{{hostmin}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ hostminbin.substr(0,8) + '.' + hostminbin.substr(8,8) + '.' + hostminbin.substr(16,8) + '.' + hostminbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>HostMax:</span>
        </div>
        <div class="col-sm-3">
            <span>{{hostmax}}</span>
        </div>
        <div class="col-sm-6">
            <span>{{ hostmaxbin.substr(0,8) + '.' + hostmaxbin.substr(8,8) + '.' + hostmaxbin.substr(16,8) + '.' + hostmaxbin.substr(24,8) }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>IP Adresses Number:</span>
        </div>
        <div class="col-sm-3">
            <span>{{ipsnumber}}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <span>Hosts Number:</span>
        </div>
        <div class="col-sm-3">
            <span>{{hostsnumber}}</span>
        </div>
    </div>
</div>
</template>

<script>
import VueIp from 'vue-ip'
export default {
    components:  {VueIp},
    data: function() {
        return {
            data: [],
            ip: '',
            ipbin: '',
            netmask: '',
            netmaskbin: '',
            wildcard: '',
            wildcardbin: '',
            network: '',
            networkbin: '',
            broadcast: '',
            hostmin: '',
            hostminbin: '',
            hostmax: '',
            hostmaxbin: '',
            ipsnumber: '',
            hostsnumber: '',
            options: [
                {mask: '0.0.0.0', bit: 0},
                {mask: '128.0.0.0', bit: 1},
                {mask: '192.0.0.0', bit: 2},
                {mask: '224.0.0.0', bit: 3},
                {mask: '240.0.0.0', bit: 4},
                {mask: '248.0.0.0', bit: 5},
                {mask: '252.0.0.0', bit: 6},
                {mask: '254.0.0.0', bit: 7},
                {mask: '255.0.0.0', bit: 8},
                {mask: '255.128.0.0', bit: 9},
                {mask: '255.192.0.0', bit: 10},
                {mask: '255.224.0.0', bit: 11},
                {mask: '255.240.0.0', bit: 12},
                {mask: '255.248.0.0', bit: 13},
                {mask: '255.252.0.0', bit: 14},
                {mask: '255.254.0.0', bit: 15},
                {mask: '255.255.0.0', bit: 16},
                {mask: '255.255.128.0', bit: 17},
                {mask: '255.255.192.0', bit: 18},
                {mask: '255.255.224.0', bit: 19},
                {mask: '255.255.240.0', bit: 20},
                {mask: '255.255.248.0', bit: 21},
                {mask: '255.255.252.0', bit: 22},
                {mask: '255.255.254.0', bit: 23},
                {mask: '255.255.255.0', bit: 24},
                {mask: '255.255.255.128', bit: 25},
                {mask: '255.255.255.192', bit: 26},
                {mask: '255.255.255.224', bit: 27},
                {mask: '255.255.255.240', bit: 28},
                {mask: '255.255.255.248', bit: 29},
                {mask: '255.255.255.252', bit: 30},
                {mask: '255.255.255.254', bit: 31},
                {mask: '255.255.255.255', bit: 32},
            ],
            ipAddress: '',
            bitMask: '', //24,
        }
    },
    mounted() {
        this.update()
    },
    methods: {
        change(ip, valid) {
            this.ipAddress = ip;
            console.log(ip, valid);
        },
        update() {
            axios.get('/ip-calculate').then((response) => {
                    this.data = response.data
                    this.ipAddress = response.data.ipAddress
                    this.bitMask = response.data.bitMask
                    this.ip = response.data.ip
                    this.ipbin = response.data.ipbinary
                    this.netmask = response.data.netmask
                    this.netmaskbin = response.data.netmaskbin
                    this.wildcard = response.data.wildcard
                    this.wildcardbin = response.data.wildcardbin
                    this.network = response.data.network
                    this.networkbin = response.data.networkbin
                    this.broadcast = response.data.broadcast
                    this.hostmin = response.data.hostmin
                    this.hostminbin = response.data.hostminbin
                    this.hostmax = response.data.hostmax
                    this.hostmaxbin = response.data.hostmaxbin
                    this.ipsnumber = response.data.ipsnumber
                    this.hostsnumber = response.data.hostsnumber
                });
        },
        sendQuery() {
            axios({
                    method: 'get',
                    url: '/ip-calculate',
                    params: {ipAddress: this.ipAddress, bitMask: this.bitMask}
                }).then((response) => {
                    this.data = response.data
                    this.ipAddress = response.data.ipAddress
                    this.bitMask = response.data.bitMask
                    this.ip = response.data.ip
                    this.ipbin = response.data.ipbinary
                    this.netmask = response.data.netmask
                    this.netmaskbin = response.data.netmaskbin
                    this.wildcard = response.data.wildcard
                    this.wildcardbin = response.data.wildcardbin
                    this.network = response.data.network
                    this.networkbin = response.data.networkbin
                    this.broadcast = response.data.broadcast
                    this.hostmin = response.data.hostmin
                    this.hostminbin = response.data.hostminbin
                    this.hostmax = response.data.hostmax
                    this.hostmaxbin = response.data.hostmaxbin
                    this.ipsnumber = response.data.ipsnumber
                    this.hostsnumber = response.data.hostsnumber
                });
        }
    }
}



</script>

<style>
    input {
        color: #6c757d!important;
    }
/*    .select {
     height: calc(2.118rem + 2px)!important;
    }*/
    .sendquery {
        justify-content: center;
        align-items: center;
    }
    button {
            margin-top: 13px;
    }
</style>