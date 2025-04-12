import React from 'react'
import pregnancyImg1 from '../public/pregnancyPhotos/pregnancyImg1.jpg'
import pregnancyImg2 from '../public/pregnancyPhotos/pregnancyImg2.jpg'
import pregnancyImg3 from '../public/pregnancyPhotos/pregnancyImg3.jpg'
import pregnancyImg4 from '../public/pregnancyPhotos/pregnancyImg4.jpg'
import pregnancyImg5 from '../public/pregnancyPhotos/pregnancyImg5.jpg'
import pregnancyImg6 from '../public/pregnancyPhotos/pregnancyImg6.jpg'
import pregnancyImg7 from '../public/pregnancyPhotos/pregnancyImg7.jpg'
import pregnancyImg8 from '../public/pregnancyPhotos/pregnancyImg8.jpg'
import pregnancyImg9 from '../public/pregnancyPhotos/pregnancyImg9.jpg'
import PregnancyGalleryImg from './PregnancyGalleryImg'

const PregnancyGallery = () => {
  return (
    <div className='max-w-[1240px] mx-auto text-center py-32'>
        <h1 className='textLibre text-2xl font-bold pb-2'>Galerie photo de grossesse</h1>
        <div className='grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4'>
            <PregnancyGalleryImg pregnancyImg={pregnancyImg1} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg2} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg3} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg4} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg5} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg6} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg7} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg8} />
            <PregnancyGalleryImg pregnancyImg={pregnancyImg9} />
        </div>
    </div>
  )
}

export default PregnancyGallery