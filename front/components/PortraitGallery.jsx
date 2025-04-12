import React from 'react'
import portraitImg1 from '../public/portraitPhotos/portraitImg1.jpg'
import portraitImg2 from '../public/portraitPhotos/portraitImg2.jpg'
import portraitImg3 from '../public/portraitPhotos/portraitImg3.jpg'
import portraitImg4 from '../public/portraitPhotos/portraitImg4.jpg'
import portraitImg5 from '../public/portraitPhotos/portraitImg5.jpg'
import portraitImg6 from '../public/portraitPhotos/portraitImg6.jpg'
import portraitImg7 from '../public/portraitPhotos/portraitImg7.jpg'
import portraitImg8 from '../public/portraitPhotos/portraitImg8.jpg'
import portraitImg9 from '../public/portraitPhotos/portraitImg9.jpg'
import portraitImg10 from '../public/portraitPhotos/portraitImg10.jpg'
import PortraitGalleryImg from './PortraitGalleryImg'

const PortraitGallery = () => {
  return (
    <div className='max-w-[1240px] mx-auto text-center py-32'>
    <h1 className='textLibre text-2xl font-bold pb-2'>Galerie photo de portrait</h1>
    <div className='grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4'>
        <PortraitGalleryImg portraitImg={portraitImg1} />
        <PortraitGalleryImg portraitImg={portraitImg2} />
        <PortraitGalleryImg portraitImg={portraitImg3} />
        <PortraitGalleryImg portraitImg={portraitImg4} />
        <PortraitGalleryImg portraitImg={portraitImg5} />
        <PortraitGalleryImg portraitImg={portraitImg6} />
        <PortraitGalleryImg portraitImg={portraitImg7} />
        <PortraitGalleryImg portraitImg={portraitImg8} />
        <PortraitGalleryImg portraitImg={portraitImg9} />
        <PortraitGalleryImg portraitImg={portraitImg10} />
    </div>
</div>
  )
}

export default PortraitGallery