function removeTrack(trackId) {
    fetch(`/my-playlists/${playlistId}/track/${trackId}`, { method: 'DELETE' })
        .then(response => location.reload());
}