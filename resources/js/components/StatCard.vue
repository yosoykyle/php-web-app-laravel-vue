<!--
  =================================================================================================
  StatCard.vue (The "Dashboard Widget")
  =================================================================================================
  
  ANALOGY:
  Think of this as a reusable sticker code.
  Instead of writing the code for a blue card, then a green card, then a yellow card...
  We write ONE "Card" component and just tell it: "Be blue", "Be green", etc.
-->
<template>
  <div :class="[
    'bg-white rounded-lg shadow-md p-6 border-l-4 transition hover:shadow-lg',
    borderColor
  ]">
    <div class="flex items-center justify-between">
      <div>
        <p class="text-sm font-medium text-gray-600 mb-1">{{ title }}</p>
        <p class="text-3xl font-bold text-gray-900">{{ value }}</p>
      </div>
      <div :class="['p-3 rounded-full', bgColor]">
        <svg v-if="icon === 'clipboard-list'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <svg v-else-if="icon === 'check-circle'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <svg v-else-if="icon === 'clock'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

// PROPS (The "Instructions")
// These are the values passed DOWN from the parent (App.vue).
// It's like filling out a form when you order the sticker:
// - Title: "Total Tasks"
// - Value: 10
// - Color: "blue"
const props = defineProps({
  title: String,
  value: Number,
  icon: String,
  color: String
});

// COMPUTED STYLES (The "Paint Mixer")
// Based on the 'color' prop (e.g., 'blue'), we decide exactly which CSS classes to use.
// logical step: If color is 'blue', return 'bg-blue-500'.

const borderColor = computed(() => {
  const colors = {
    blue: 'border-blue-500',
    green: 'border-green-500',
    yellow: 'border-yellow-500',
    red: 'border-red-500'
  };
  // Fallback: If the color isn't found, use gray.
  return colors[props.color] || 'border-gray-500';
});

const bgColor = computed(() => {
  const colors = {
    blue: 'bg-blue-500',
    green: 'bg-green-500',
    yellow: 'bg-yellow-500',
    red: 'bg-red-500'
  };
  return colors[props.color] || 'bg-gray-500';
});
</script>
