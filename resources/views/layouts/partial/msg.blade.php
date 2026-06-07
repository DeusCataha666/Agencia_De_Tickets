@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" style="background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #dc2626; border-radius: 0.5rem; padding: 1rem 1.25rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
            <span style="display: flex; align-items: center;">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong style="margin-right: 0.5rem;">Advertencia -</strong> {{ $error }}
            </span>
            <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'" style="color: #dc2626; opacity: 0.7; font-size: 1.5rem; border: none; background: none; cursor: pointer;">×</button>
        </div>
    @endforeach
@endif

@if(session('successMsg'))
    <div class="alert alert-success" style="background-color: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #059669; border-radius: 0.5rem; padding: 1rem 1.25rem; margin-bottom: 1rem; display: flex; justify-content: space-between; align-items: center;">
        <span style="display: flex; align-items: center;">
            <i class="fas fa-check-circle mr-2"></i>
            <strong style="margin-right: 0.5rem;">Éxito -</strong> {{ session('successMsg') }}
        </span>
        <button type="button" aria-hidden="true" class="close" onclick="this.parentElement.style.display='none'" style="color: #059669; opacity: 0.7; font-size: 1.5rem; border: none; background: none; cursor: pointer;">×</button>
    </div>
@endif