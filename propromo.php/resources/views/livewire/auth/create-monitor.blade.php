<?php

use App\Jobs\CreateMonitor;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Traits\MonitorCreator;

new class extends Component {
    use MonitorCreator;

    public $notifications = [];
    public $create_monitor_error;
    public $error_head;
    public $project_url;
    public $pat_token;
    public $disable_pat_token = true;

    protected $rules = [
        'project_url' => 'required|url|min:10|max:2048',
        'pat_token' => 'required|string|min:10'
    ];

    #[On('echo:monitors,MonitorProcessed')]
    public function handleMonitorUpdated()
    {
        Log::info("Handle Monitor entered.");
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect()->to('/register');
        }

        try {
            $this->validate();

            $project = $this->create_monitor($this->project_url, $this->pat_token);

            return redirect()->to('/monitors/' . $project->id);
        } catch (ValidationException $e) {
            $this->create_monitor_error = "Invalid input: " . implode(", ", $e->validator->errors()->all());
            $this->error_head = "Validation Failed!";
        } catch (Exception $e) {
            $this->create_monitor_error = $e->getMessage();
            $this->error_head = "Something went wrong...";
        }
    }

    public function on_create()
    {
        CreateMonitor::dispatch($this->project_url, $this->pat_token, $this->disable_pat_token);

    }

    public function switchTo()
    {
        return redirect()->to('/create-open-source-monitor');
    }
};
?>

<div class="flex flex-col items-center w-full h-full bg-gray-100">
    <div class="flex flex-col justify-center mt-10">
        <div class="flex gap-1 items-center mt-16 mb-2 sm:mt-10">
            <div class="w-[30px] h-[30px] rounded-full bg-primary-blue"></div>
            <div class="w-2 h-1 bg-primary-blue"></div>
            <div class="w-[30px] h-[30px] bg-primary-blue rounded-full"></div>
        </div>

        <div class="px-10 pt-8 pb-8 mx-auto w-96 max-w-full bg-white rounded-lg border border-border-color">
            <h1 class="mb-8 text-6xl uppercase font-koulen text-primary-blue">Create Monitor</h1>

            <form wire:submit.prevent="create" class="flex flex-col gap-2">
                <sl-input size="medium" required wire:model.defer="project_url" placeholder="Your Project URL" type="text"></sl-input>
                <sl-input size="medium" wire:model.defer="pat_token" placeholder="Your PAT Token (Optional)" type="text"></sl-input>
                <sl-switch class="pt-1 text-secondary-grey" size="medium" wire:click="switchTo()">Open Source</sl-switch>

                <div class="flex justify-between items-end mt-5">
                    <a class="text-sm no-underline text-primary-blue hover:underline"
                        href="{{ url('join') }}">
                        Already have a monitor?
                    </a>

                    <sl-button size="medium" wire:click="on_create">Create</sl-button>
                </div>
            </form>
        </div>
    </div>

    <sl-dialog wire:ignore label="Dialog" class="dialog-overview">
        <sl-button slot="footer" onclick="closeModal()" disabled="true">Open Monitor</sl-button>
    </sl-dialog>

    <script>
        document.addEventListener("livewire:load", function () {
            Livewire.on('open-modal', () => {
                document.querySelector('.dialog-overview').show();
            });
        });

        function closeModal() {
            document.querySelector('.dialog-overview').hide();
        }

        const dialog = document.querySelector('.dialog-overview');
        const openButton = dialog.nextElementSibling;
        const closeButton = dialog.querySelector('sl-button[slot="footer"]');

        openButton.addEventListener('click', () => dialog.show());
        closeButton.addEventListener('click', () => dialog.hide());
    </script>

    @if($create_monitor_error)
    <sl-alert variant="danger" open closable class="mt-4">
        <sl-icon wire:ignore slot="icon" name="patch-exclamation"></sl-icon>
        <strong>{{ $error_head }}</strong><br/>
        {{ $create_monitor_error }}
    </sl-alert>
    @endif
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
 