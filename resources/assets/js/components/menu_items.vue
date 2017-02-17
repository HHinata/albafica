<template>
  <li>
    <a @click="toggle" class="waves-effect waves-block" :class="isFolder? 'menu-toggle':''" v-bind:href="model.url">
    <span >
      {{ model.menuName }}
    </span>
    </a>
    <ul v-if="isFolder" class="ml-menu" >
      <menu-items v-for="item in model.children" :model="item"></menu-items>
    </ul>
  </li>
</template>

<script>
export default {
  name: 'menuItems',
  props: ['model'],
  data: function() {
    return {
      open: false,
    }
  },
  computed: {
    isFolder: function() {
      return this.model.children && this.model.children.length
    }
  },
  methods: {
    toggle: function(e) {
      if (this.isFolder) {
        this.open = !this.open
      }
    }
  }
}
</script>
