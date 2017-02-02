<template>
  <li>
    <a @click="toggle" class="waves-effect waves-block" :class="isFolder? 'menu-toggle':''">
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
  props: ['model', 'isFolder'],
  data() {
    return {
      open: false,
      isFolder: true
    }
  },
  computed: {
    isFolder: function() {
      return this.model.children && this.model.children.length
    }
  },
  methods: {
    toggle: function() {
      if (this.isFolder) {
        this.open = !this.open
        console.log(this.open)
      }
    }
  }
}
</script>
