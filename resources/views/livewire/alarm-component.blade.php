<div>
    <div class="space-y-4 w-full mt-4">
        <div class="rounded-lg px-6 py-4 text-sm bg-white shadow-md">
            <div class="flex items-center justify-between">
                <h5 class="font-bold text-xl">Scheduled Alarms</h5>

                <x-primary-button wire:click="showModal" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    {{ __('Add New') }}
                </x-primary-button>

            </div>
            <div class="py-2">
                <table class="w-full text-left">
                    <thead class="text-gray-500">
                        <tr class="h-10">
                            <th class="pr-4 font-normal">Alarm</th>
                            <th class="pr-4 font-normal">Reminder</th>
                            <th class="w-full pr-4 font-normal">Time</th>
                            <th class="w-full pr-4 font-normal">Date</th>
                            <th class="pr-4 font-normal">Repeat</th>
                            <th class="w-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alarms as $alarm)
                            <tr class="h-12 border-t border-gray-100 dark:border-gray-700">
                                <td class="pr-4">{{ $alarm->alarm }}</td>
                                <td class="min-w-[8rem] pr-4">{{ $alarm->reminder }}</td>
                                <td class="max-w-md pr-4">{{ $alarm->time }}</td>
                                <td class="pr-4">{{ $alarm->date }}</td>
                                <td class="pr-4">{{ $alarm->repeat }}</td>
                                <td>
                                    <div class="flex justify-end">
                                        <button wire:click="editAlarm('{{ $alarm->id }}')"
                                            class="text-left px-2 py-1 hover:bg-gray-200 rounded m-1">
                                            Edit
                                        </button>
                                        <button wire:click="deleteAlarm('{{ $alarm->id }}')"
                                            class="text-left px-2 py-1 bg-red-100 hover:bg-red-200 rounded m-1 transition-all">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div>
        <x-dialog wire:model="showModal" maxWidth="2xl">
            <x-slot name="title">
                {{ $alarmId ? 'Update Alarm' : 'Create Alarm' }}
            </x-slot>

            <x-slot name="content">

                <div class="mt-4">
                    <x-input-label for="alarm" :value="__('Alarm')" />
                    <x-text-input id="alarm" class="block mt-1 w-full" type="text" wire:model="alarm" />
                    @error('alarm')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-input-label for="reminder" :value="__('Reminder')" />
                    <x-text-input id="reminder" class="block mt-1 w-full" type="text" wire:model="reminder" />
                    @error('reminder')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-input-label for="dateTime" :value="__('Date-Time')" />
                    <x-text-input id="dateTime" class="block mt-1 w-full" type="datetime-local" wire:model="dateTime" />
                    @error('dateTime')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-input-label for="repeat" :value="__('Repeat')" />
                    <select id="repeat" class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" wire:model="repeat">
                        <option value="Never">Never</option>
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="Yearly">Yearly</option>
                    </select>
                    @error('repeat')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @if ($repeat != 'Never')
                    <div class="mt-4">
                        <x-input-label :value="__('Repeat Times')" for="repeatTimes" />

                        <x-text-input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            wire:model="repeatTimes" id="repeatTimes" type="number" min="1" required />
                        @error('repeatTimes')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-input-label :value="__('Repeat Unit')" for="repeatUnit" />
                        <select
                            class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
                            wire:model="repeatUnit" id="repeatUnit" required>
                            <option value="day">Day(s)</option>
                            <option value="week">Week(s)</option>
                            <option value="month">Month(s)</option>
                            <option value="year">Year(s)</option>
                        </select>
                        @error('repeatUnit')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

            </x-slot>
            <x-slot name="footer">
                <x-secondary-button class="ml-4" wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                @if ($alarmId)
                    <x-primary-button class="ml-4" wire:click="updateAlarm" wire:loading.attr="disabled">
                        {{ __('Update') }}
                    </x-primary-button>
                @else
                    <x-primary-button class="ml-4 uppercase" wire:click="createAlarm" wire:loading.attr="disabled">
                        {{ __('Create') }}
                    </x-primary-button>
                @endif
            </x-slot>
        </x-dialog>
    </div>


</div>
