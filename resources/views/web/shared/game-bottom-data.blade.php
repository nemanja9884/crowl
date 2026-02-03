<div class="badge-container">
    <div class="points-display">
        {{$points}} {{trans('home.Points')}}
    </div>

    @if($userBadge)
        <div class="mb-3">
            <img src="{{ $userBadge->image }}"
                 alt="User Badge"
                 class="badge-image-small"> <!-- Dodato -small -->
        </div>
    @endif

    <h5 class="fw-bold badge-name-small"> <!-- Dodato -small -->
        @if(!$userBadge)
            {{trans('home.No Badge')}}
        @else
            {{$userBadge->name}}
        @endif
    </h5>
</div>

<style>
    .badge-container {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 15px;
        padding: 1.25rem; /* Smanjeno sa 1.5rem */
        color: white;
        text-align: center;
    }

    .badge-image-small {
        width: 70px; /* Smanjeno sa 100px */
        height: 70px;
        border-radius: 50%;
        border: 3px solid white; /* Smanjeno sa 4px */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .points-display {
        font-size: 1.6rem; /* Smanjeno sa 2rem */
        font-weight: bold;
        background: white;
        color: #667eea;
        padding: 0.4rem 1.25rem; /* Smanjeno */
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 0.75rem; /* Smanjeno */
    }

    .badge-name-small {
        font-size: 1rem; /* Smanjeno */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .badge-image-small {
            width: 60px;
            height: 60px;
        }

        .points-display {
            font-size: 1.3rem;
        }

        .badge-name-small {
            font-size: 0.9rem;
        }
    }
</style>
