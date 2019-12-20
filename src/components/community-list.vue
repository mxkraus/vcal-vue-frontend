<template>
  <div class="communities">
    <b-form-input
      id="search"
      v-model="search"
      placeholder="Verein suchen"
    ></b-form-input>

    <div
      class="community"
      v-for="community in filteredComunity"
      :key="community.id"
    >
      <b-button v-b-toggle="community.verein" variant="primary">
        {{ community.verein_full }}
        <b-badge variant="light">
          {{ getObjectSize(community.termine) }}
        </b-badge>
      </b-button>

      <b-collapse :id="community.verein" class="mt-2">
        <b-list-group>
          <b-list-group-item
            class="event"
            v-for="(value, name, index) in community.termine"
            :key="index"
          >
            <div class="d-flex w-100 justify-content-between">
              <h5>{{ value.timefrom }}</h5>
              <small>Download <i class="accessible-icon"></i></small>
            </div>
            <p class="mb-1">{{ value.title }}</p>
          </b-list-group-item>
        </b-list-group>
      </b-collapse>
    </div>
  </div>
</template>

<script>
export default {
  name: "Events",
  data() {
    return {
      communities: [],
      search: "",
      isCollapsed: false
    };
  },
  methods: {
    expandChild: function() {
      this.isCollapsed = true;
    },
    mix: function(a) {
      for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
      }
      return a;
    },
    getObjectSize: function(obj) {
      var size = 0,
        key;
      for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
      }
      return size;
    }
  },
  created: function() {
    this.$http
      .get("https://mxkraus.de/Vereinskalender/get-vcal-events.php?year=2020")
      .then(
        response => {
          this.communities = this.mix(response.body);
        },
        response => {
          console.log(response.error);
        }
      );
  },
  mounted: function() {},
  computed: {
    filteredComunity: function() {
      return this.communities.filter(community => {
        return (
          community.verein.toLowerCase().match(this.search) ||
          community.verein.match(this.search)
        );
      });
    }
  }
};
</script>

<style lang="scss" scoped>
// @import '../assets/sass/reset.scss';
#search {
  margin-bottom: 15px;
}
.communities {
  height: 100%;
  width: 100%;
  padding: 20px;
  .community {
    width: 100%;
    margin-bottom: 15px;
    cursor: pointer;

    .timefrom {
      font-weight: bold;
    }
  }
}
</style>
