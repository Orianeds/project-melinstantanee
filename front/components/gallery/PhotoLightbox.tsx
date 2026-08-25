'use client'

import Lightbox from 'yet-another-react-lightbox'
import Zoom from 'yet-another-react-lightbox/plugins/zoom'
import Thumbnails from 'yet-another-react-lightbox/plugins/thumbnails'

import 'yet-another-react-lightbox/styles.css'
import 'yet-another-react-lightbox/plugins/thumbnails.css'

import { PhotoDto } from '@/dto/gallery/photo.dto'

type Props = {
  photos: PhotoDto[]
  isOpen: boolean
  currentIndex: number
  onClose: () => void
}

export default function PhotoLightbox({
  photos,
  isOpen,
  currentIndex,
  onClose,
}: Props) {
  return (
    <Lightbox
      open={isOpen}
      close={onClose}
      index={currentIndex}
      plugins={[Zoom, Thumbnails]}
      slides={photos.map((photo) => ({
        src: photo.imageUrl,
      }))}
    />
  )
}