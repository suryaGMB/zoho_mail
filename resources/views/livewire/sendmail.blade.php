<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>
    <div>
        <div>
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" wire:model="email" required>
        </div>
        <div>
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" wire:model="subject" required>
        </div>
        <div>
            <label for="body">Body</label>
            <textarea class="form-control" id="body" wire:model="body" required></textarea>
        </div>
        <button wire:click="sendEmail" type="submit" class="btn btn-primary">Send Email</button>
    </div>
</div>
