<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Task') }}
        </h2>
    </x-slot>
    
        <div class="flex items-center justify-center max-w-7xl bg-gray-100">
            <div class="px-8 py-6 mt-6 text-left bg-white shadow-lg">
                <form class="px-6" action="{{url('admin/tasks/store')}}" method="POST">
                    @csrf
                    <div>
                        <label>Task</label>
                        <input type="text" name="description" placeholder="Task" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="mt-4">
                        <label>Date Due</label>
                        <input type="date" name="due_date" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                    </div>
                    <div class="mt-4">
                        <label>User</label>
                        <select class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600" name="user">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-baseline justify-end">
                        <button class="px-6 py-2 mt-4 text-white bg-gray-500 rounded-lg hover:bg-blue-900" type="submit">Assign</button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>