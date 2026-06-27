<template>
    <div>
        <div id="markerLocation" ></div>
    </div>
</template>
<script>
export default {
    props: ['lat', 'lng'],
    data() {
        return{
            googleMap: null,
            marker: null,
        }
    },
    mounted() {
        this.initMap();
    },
    created() {
        this.$on('clicked', this.initMap);
    },
    methods: {
        initMap() {
            if (this.googleMap && this.marker.getPosition().lat() == this.lat) {
                return true;
            }
            var myLatLng = {lat: this.lat, lng: this.lng};
            // Create a map object and specify the DOM element
            // for display.
            this.googleMap = new google.maps.Map(document.getElementById('markerLocation'), {
                center: myLatLng,
                zoom:2
            });
            this.marker = new google.maps.Marker({
                position: myLatLng,
                map: this.googleMap,
                title: 'Event location!',
                draggable:true,
            });
//                this.marker.addListener('dragend',this.handleEvent);
            google.maps.event.addListener(this.marker, 'dragend', this.handleEvent);
            google.maps.event.addListener(this.googleMap, 'click', this.handleEvent);
        },
        handleEvent(event) {
            this.$emit('update:lat', event.latLng.lat());
            this.$emit('update:lng', event.latLng.lng());
            var marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                draggable: true,
            });
        }
    },
    watch: {
        lat: function (val) {
            this.initMap();
        }
    }
}
</script>
<style scoped>
#markerLocation{
    height: 400px;
}
</style>
