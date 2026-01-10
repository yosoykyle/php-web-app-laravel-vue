<template>
  <div class="border-b border-gray-200 hover:bg-gray-50 transition">
    <div class="p-4 flex items-center justify-between gap-4">
      <div class="flex items-center gap-4 flex-1">
        <button
          @click="$emit('toggle', task.id)"
          :class="[
            'flex-shrink-0 w-6 h-6 rounded-full border-2 transition',
            task.completed
              ? 'bg-green-500 border-green-500'
              : 'border-gray-300 hover:border-green-500'
          ]"
        >
          <svg
            v-if="task.completed"
            class="w-full h-full text-white"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="3"
              d="M5 13l4 4L19 7"
            />
          </svg>
        </button>

        <div class="flex-1">
          <p
            :class="[
              'text-gray-800 transition',
              task.completed && 'line-through text-gray-500'
            ]"
          >
            {{ task.text }}
          </p>
          <p class="text-xs text-gray-500 mt-1">
            {{ formatDate(task.createdAt) }}
          </p>
        </div>
      </div>

      <button
        @click="$emit('delete', task.id)"
        class="flex-shrink-0 p-2 text-red-500 hover:bg-red-50 rounded-lg transition"
        title="Delete task"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
          />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  task: Object
});

defineEmits(['toggle', 'delete']);

const formatDate = (date) => {
  const d = new Date(date);
  const now = new Date();
  const diff = now - d;
  const minutes = Math.floor(diff / 60000);
  const hours = Math.floor(diff / 3600000);
  const days = Math.floor(diff / 86400000);

  if (minutes < 1) return 'Just now';
  if (minutes < 60) return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
  if (hours < 24) return `${hours} hour${hours > 1 ? 's' : ''} ago`;
  if (days < 7) return `${days} day${days > 1 ? 's' : ''} ago`;

  return d.toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: d.getFullYear() !== now.getFullYear() ? 'numeric' : undefined
  });
};
</script>
