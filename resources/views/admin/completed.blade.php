<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Completed Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:mx-6 lg:mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-md">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                                    User
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                                    Description
                                                </th>
                                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium">
                                                    Due Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($tasks as $task)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{$task->user->name}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{$task->description}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{$task->due_date}}
                                                </td>
                                                <td>
                                                @can('update', $task)
                                                    <a href="{{url('tasks/edit', $task)}}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 text-white">Edit</a>
                                                @endcan
                                                </td>
                                                <td>
                                                @can('delete', $task)
                                                <form action="{{url('admin/tasks',$task)}}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 text-white" type="submit">Delete</button>
                                                </form>                
                                                @endcan
                                                </td>
                                                <td>
                                                <form action="{{url('admin/tasks/comment',$task)}}" method="POST">
                                                    @csrf
                                                    <textarea class="mb-4 inline-flex items-center px-4 py-2 " name="comment"></textarea>
                                                    <button class="mb-4 pb-6 bg-gray-800 px-4 text-white" type="submit">Post</button>
                                                </form>
                                                </td>
                                                <td>
                                                <form action="{{url('admin/tasks/approve',$task)}}" method="POST">
                                                    @csrf
                                                    <button class="mb-4 pb-6 bg-gray-800 px-4 text-white" type="submit">Approved</button>
                                                </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>