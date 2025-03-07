<?php

use App\Jobs\CreateMonitor;
use App\Models\MonitorLogs;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use App\Traits\MonitorCreator;

new class extends Component {
    use MonitorCreator;

    public $project_url;
    public $pat_token = "use-open-source-program";
    public $disable_pat_token = true;

    protected $rules = [
        'project_url' => 'required|min:10|max:2048'
    ];

    public function create()
    {
        if (Auth::check()) {
            try {
                $this->validate();
                $this->dispatch('monitor-creation-called');
                $this->dispatch('monitor-log-sent', ["message" => "Monitor creation called..."]);
                $project = $this->create_monitor($this->project_url, $this->pat_token);
                $this->dispatch('monitor-log-sent', ["message" => "Monitor creation completed..."]);
                CreateMonitor::dispatch($project);
              //  return redirect('/monitors/' . $project->id);
            } catch (ValidationException $e) {
                $message = implode(", ", $e->validator->errors()->all());
                logger()->error('Create Monitor Error', ['errors' => $message]);

                $this->dispatch('show-error-alert', [
                    'head' => 'Create Monitor Error',
                    'message' => $message
                ]);
            } catch (Exception $e) {
                $message = $e->getMessage();
                logger()->error('Create Monitor Error', ['message' => $message]);

                $this->dispatch('show-error-alert', [
                    'head' => 'Create Monitor Error',
                    'message' => 'Something unexpected happened!'
                ]);
            }
        } else {
            return redirect('/register');
        }
    }

    function switchTo()
    {
        return $this->redirect('create-monitor');
    }
}; ?>

<div class="flex flex-col items-center w-full h-full bg-gray-100">
    <div class="flex flex-col justify-center mt-10">
        <div class="flex gap-1 items-center mt-16 mb-2 sm:mt-10">
            <div class="w-[30px] h-[30px] rounded-full bg-primary-blue"></div>
            <div class="w-2 h-1 bg-primary-blue"></div>
            <div class="w-[30px] h-[30px] bg-primary-blue rounded-full"></div>
        </div>

        <div class="px-10 pt-8 pb-8 mx-auto w-96 max-w-full bg-white rounded-lg border border-border-color">
            <h1 class="mb-8 text-6xl uppercase font-koulen text-primary-blue">Create Monitor</h1>

            <form wire:submit="create" class="flex flex-col gap-2">
                <sl-input size="medium" required wire:model="project_url" placeholder="Your Project URL"
                          type="text"></sl-input>
                <sl-switch class="pt-1 text-secondary-grey" size="medium" wire:click="switchTo()" checked>Open Source
                </sl-switch>

                <div class="flex justify-between items-end mt-5">
                    <a class="text-sm no-underline text-primary-blue hover:underline"
                       href="{{ url('join') }}">
                        Already have a monitor?
                    </a>

                    <sl-button type="submit" wire:loading.attr="disabled" wire:ignore>Create</sl-button>
                </div>
            </form>
            <livewire:base.creation-dialog></livewire:base.creation-dialog>
        </div>
    </div>
</div>

<!-- <div class="relative mt-2 w-full aspect-video">
    <iframe
        class="absolute top-0 left-0 w-full h-full rounded-lg"
        src="https://player.vimeo.com/video/953693369?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479&background=1&responsive=1"
        frameborder="0"
        allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
        title="Propromo Preview">
    </iframe>
</div> -->
