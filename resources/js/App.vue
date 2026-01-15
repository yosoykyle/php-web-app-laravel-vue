<!--
  =================================================================================================
  App.vue (The "Main Stage")
  =================================================================================================
  
  ANALOGY:
  This is the main component of your application.
  In Vue, a component has 3 parts, like a sandwich:
  1. <template> (The Bread/Visuals): HTML code (what you see).
  2. <script> (The Meat/Logic): JavaScript code (how it works).
  3. <style> (The Sauce/CSS): Styling (how it looks).
-->
<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h1 class="text-2xl font-bold text-gray-900">TaskMaster</h1>
          </div>
          <div class="flex items-center space-x-4">
            <span class="text-sm text-gray-600">{{ currentDate }}</span>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <StatCard
          title="Total Tasks"
          :value="tasks.length"
          icon="clipboard-list"
          color="blue"
        />
        <StatCard
          title="Completed"
          :value="completedTasks"
          icon="check-circle"
          color="green"
        />
        <StatCard
          title="Pending"
          :value="pendingTasks"
          icon="clock"
          color="yellow"
        />
      </div>

      <!-- Task Input -->
      <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Add New Task</h2>
        <div class="flex gap-3">
          <input
            v-model="newTask"
            @keyup.enter="addTask"
            type="text"
            placeholder="What needs to be done?"
            class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
          />
          <button
            @click="addTask"
            class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium shadow-sm hover:shadow-md"
          >
            Add Task
          </button>
        </div>
      </div>

      <!-- Filter Tabs -->
      <div class="bg-white rounded-lg shadow-md mb-8">
        <div class="flex border-b">
          <button
            v-for="filter in filters"
            :key="filter"
            @click="currentFilter = filter"
            :class="[
              'px-6 py-3 font-medium transition',
              currentFilter === filter
                ? 'border-b-2 border-indigo-600 text-indigo-600'
                : 'text-gray-600 hover:text-gray-800'
            ]"
          >
            {{ filter }}
          </button>
        </div>
      </div>

      <!-- Tasks List -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div v-if="filteredTasks.length === 0" class="p-12 text-center">
          <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <p class="text-gray-500 text-lg">No tasks found</p>
        </div>

        <TransitionGroup name="list" tag="div">
          <TaskItem
            v-for="task in filteredTasks"
            :key="task.id"
            :task="task"
            @toggle="toggleTask"
            @delete="deleteTask"
          />
        </TransitionGroup>
      </div>
    </main>

    <!-- Footer -->
    <footer class="mt-12 py-6 text-center text-gray-600">
      <p class="text-sm">Built with Laravel + Vue 3 + Tailwind CSS</p>
    </footer>
  </div>
</template>

<script setup>
/**
 *  <script setup>
 *  This is the "Brain" of the component.
 *  We use the "Composition API" here, which is the modern way to write Vue.
 */
import { ref, computed, onMounted } from 'vue';
import StatCard from './components/StatCard.vue';
import TaskItem from './components/TaskItem.vue';

// STATE (The "Memory")
// 'ref' makes a variable "reactive". If it changes, the HTML updates automatically.
const tasks = ref([]);
const newTask = ref('');
const currentFilter = ref('All');
const filters = ['All', 'Active', 'Completed'];

// COMPUTED PROPERTIES (The "Calculator")
// These values are automatically calculated based on other data.
// If 'tasks' changes, these update instantly.

const currentDate = computed(() => {
  return new Date().toLocaleDateString('en-US', {
    weekday: 'long',
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
});

const completedTasks = computed(() => {
  return tasks.value.filter(task => task.completed).length; 
});

const pendingTasks = computed(() => {
  return tasks.value.filter(task => !task.completed).length;
});

const filteredTasks = computed(() => {
  if (currentFilter.value === 'Active') {
    return tasks.value.filter(task => !task.completed);
  } else if (currentFilter.value === 'Completed') {
    return tasks.value.filter(task => task.completed);
  }
  return tasks.value;
});

const addTask = () => {
  if (newTask.value.trim()) {
    const task = {
      id: Date.now(),
      text: newTask.value,
      completed: false,
      createdAt: new Date().toISOString()
    };

    // Save to backend
    axios.post('/api/tasks', task)
      .then(response => {
        tasks.value.unshift(response.data);
        newTask.value = '';
      })
      .catch(error => {
        console.error('Error adding task:', error);
        // Fallback to local storage
        tasks.value.unshift(task);
        saveTasks();
        newTask.value = '';
      });
  }
};

const toggleTask = (id) => {
  const task = tasks.value.find(t => t.id === id);
  if (task) {
    task.completed = !task.completed;

    // Update backend
    axios.put(`/api/tasks/${id}`, task)
      .catch(error => {
        console.error('Error updating task:', error);
        // Fallback to local storage
        saveTasks();
      });
  }
};

const deleteTask = (id) => {
  axios.delete(`/api/tasks/${id}`)
    .then(() => {
      tasks.value = tasks.value.filter(task => task.id !== id);
    })
    .catch(error => {
      console.error('Error deleting task:', error);
      // Fallback to local storage
      tasks.value = tasks.value.filter(task => task.id !== id);
      saveTasks();
    });
};

const loadTasks = () => {
  axios.get('/api/tasks')
    .then(response => {
      tasks.value = response.data;
    })
    .catch(error => {
      console.error('Error loading tasks:', error);
      // Fallback to local storage
      const saved = localStorage.getItem('tasks');
      if (saved) {
        tasks.value = JSON.parse(saved);
      }
    });
};

const saveTasks = () => {
  localStorage.setItem('tasks', JSON.stringify(tasks.value));
};

// LIFECYCLE HOOKS (The "Events")
// onMounted: "When this component first appears on screen, do this."
onMounted(() => {
  loadTasks();
});
</script>

<style scoped>
.list-enter-active,
.list-leave-active {
  transition: all 0.3s ease;
}

.list-enter-from {
  opacity: 0;
  transform: translateX(-30px);
}

.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}
</style>
