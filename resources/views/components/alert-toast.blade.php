@php
    $alertTypes = [
        'success' => ['icon' => 'fas fa-check-circle', 'color' => 'success', 'title' => 'Success'],
        'error' => ['icon' => 'fas fa-exclamation-circle', 'color' => 'error', 'title' => 'Error'],
        'warning' => ['icon' => 'fas fa-exclamation-triangle', 'color' => 'warning', 'title' => 'Warning'],
        'info' => ['icon' => 'fas fa-info-circle', 'color' => 'info', 'title' => 'Information'],
    ];
@endphp

<style>
    .notification-container {
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        max-width: 400px;
    }

    .notification {
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        border-left: 4px solid;
        padding: 1rem;
        min-width: 320px;
        transform: translateX(400px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .notification.show {
        transform: translateX(0);
        opacity: 1;
    }

    .notification.hiding {
        transform: translateX(400px);
        opacity: 0;
    }

    .notification::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .notification:hover::before {
        opacity: 1;
    }

    /* Color Variants */
    .notification.success {
        border-left-color: #10b981;
        background: linear-gradient(135deg, #f0fdf4, #ffffff);
    }

    .notification.error {
        border-left-color: #ef4444;
        background: linear-gradient(135deg, #fef2f2, #ffffff);
    }

    .notification.warning {
        border-left-color: #f59e0b;
        background: linear-gradient(135deg, #fffbeb, #ffffff);
    }

    .notification.info {
        border-left-color: #3b82f6;
        background: linear-gradient(135deg, #eff6ff, #ffffff);
    }

    .notification-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .notification-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .notification-icon {
        font-size: 1.25rem;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success .notification-icon { color: #10b981; }
    .error .notification-icon { color: #ef4444; }
    .warning .notification-icon { color: #f59e0b; }
    .info .notification-icon { color: #3b82f6; }

    .notification-close {
        background: none;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
    }

    .notification-close:hover {
        background: rgba(0, 0, 0, 0.05);
        color: #6b7280;
    }

    .notification-body {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
        padding-left: 2.25rem;
    }

    .notification-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        background: currentColor;
        opacity: 0.3;
        width: 100%;
        transform-origin: left;
        animation: progress 5s linear forwards;
    }

    @keyframes progress {
        from { transform: scaleX(1); }
        to { transform: scaleX(0); }
    }

    /* Hover pause animation */
    .notification:hover .notification-progress {
        animation-play-state: paused;
    }

    /* Responsive Design */
    @media (max-width: 640px) {
        .notification-container {
            right: 0.75rem;
            left: 0.75rem;
            max-width: none;
        }

        .notification {
            min-width: auto;
            width: 100%;
        }
    }

    /* Stacking animation for multiple notifications */
    .notification:nth-child(1) { z-index: 4; }
    .notification:nth-child(2) { z-index: 3; }
    .notification:nth-child(3) { z-index: 2; }
    .notification:nth-child(4) { z-index: 1; }
</style>

<div class="notification-container">
    @foreach ($alertTypes as $key => $data)
        @if (session($key))
            <div class="notification {{ $data['color'] }}" data-type="{{ $key }}" data-delay="5000">
                <div class="notification-header">
                    <div class="notification-title">
                        <i class="notification-icon {{ $data['icon'] }}"></i>
                        <span>{{ $data['title'] }}</span>
                    </div>
                    <button type="button" class="notification-close" aria-label="Close notification">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="notification-body">
                    {{ session($key) }}
                </div>
                <div class="notification-progress"></div>
            </div>
        @endif
    @endforeach
</div>

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const notifications = document.querySelectorAll('.notification');

        notifications.forEach((notification, index) => {
            // Staggered animation delay
            setTimeout(() => {
                notification.classList.add('show');
            }, index * 150);

            // Auto-hide functionality
            const delay = parseInt(notification.dataset.delay) || 5000;
            let hideTimeout = setTimeout(() => {
                hideNotification(notification);
            }, delay);

            // Close button functionality
            const closeBtn = notification.querySelector('.notification-close');
            closeBtn.addEventListener('click', () => {
                clearTimeout(hideTimeout);
                hideNotification(notification);
            });

            // Pause auto-hide on hover
            notification.addEventListener('mouseenter', () => {
                clearTimeout(hideTimeout);
            });

            notification.addEventListener('mouseleave', () => {
                hideTimeout = setTimeout(() => {
                    hideNotification(notification);
                }, delay);
            });
        });

        function hideNotification(notification) {
            notification.classList.remove('show');
            notification.classList.add('hiding');

            setTimeout(() => {
                notification.remove();
            }, 500);
        }

        // Keyboard accessibility
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                notifications.forEach(notification => {
                    hideNotification(notification);
                });
            }
        });
    });
</script>
@endpush
