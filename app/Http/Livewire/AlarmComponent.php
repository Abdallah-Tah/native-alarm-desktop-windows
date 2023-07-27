<?php

namespace App\Http\Livewire;

use App\Models\Alarm;
use Livewire\Component;

class AlarmComponent extends Component
{
    public $repeat = 'Never'; // 'never', 'daily', 'weekly', 'monthly', 'yearly
    public $alarm, $reminder, $dateTime, $repeatTimes, $repeatUnit, $isActive, $isCompleted, $alarmId;
    public $showModal = false;

    public function showModal()
    {
        $this->showModal = true;
    }

    public function createAlarm()
    {
        //$this dateTime = 2007-11-03T17:22

        // Extract the date from the given date-time string
        $time = explode('T', $this->dateTime);
        $date = $time[0];

        //get the time from the given date-time string
        $time = explode('T', $this->dateTime);
        $time = $time[1];

        Alarm::create([
            'alarm' => $this->alarm,
            'reminder' => $this->reminder,
            'time' => $time,
            'date' => $date,
            'repeat' => $this->repeat,
            'repeat_times' => $this->repeatTimes,
            'repeat_unit' => $this->repeatUnit,
            'is_active' => $this->isActive ? 1 : 0,
            'is_completed' => $this->isCompleted ? 1 : 0
        ]);

        $this->resetForm();
    }

    public function updateAlarm()
    {
        $alarm = Alarm::find($this->alarmId);

        $alarm->update([
            'alarm' => $this->alarm,
            'reminder' => $this->reminder,
            'time' => $this->time,
            'date' => $this->date,
            'repeat' => $this->repeat,
            'repeatTimes' => $this->repeatTimes,
            'repeatUnit' => $this->repeatUnit,
            'is_active' => $this->isActive,
            'is_completed' => $this->isCompleted
        ]);

        $this->resetForm();
    }

    // public function editAlarm($alarmId)
    // {
    //     $alarm = Alarm::find($alarmId);

    //     $this->alarm = $alarm->alarm;
    //     $this->reminder = $alarm->reminder;
    //     $this->time = $alarm->time;
    //     $this->date = $alarm->date;
    //     $this->repeat = $alarm->repeat;
    //     $this->repeatTimes = $alarm->repeatTimes;
    //     $this->repeatUnit = $alarm->repeatUnit;
    //     $this->isActive = $alarm->isActive;
    //     $this->isCompleted = $alarm->isCompleted;

    //     $this->alarmId = $alarmId;
    // }

    public function resetForm()
    {
        $this->alarm = '';
        $this->reminder = '';
        $this->dateTime = '';
        $this->repeat = '';
        $this->repeatTimes = '';
        $this->repeatUnit = '';
        $this->isActive = false;
        $this->isCompleted = false;
    }

    public function render()
    {
        return view('livewire.alarm-component', [
            'alarms' => Alarm::all(),
        ]);
    }
}
