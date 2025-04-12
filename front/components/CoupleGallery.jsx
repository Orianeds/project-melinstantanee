import React from 'react'
import coupleImg1 from '../public/couplePhotos/coupleImg1.jpg';
import coupleImg2 from '../public/couplePhotos/coupleImg2.jpg';
import coupleImg3 from '../public/couplePhotos/coupleImg3.jpg';
import coupleImg4 from '../public/couplePhotos/coupleImg4.jpg';
import coupleImg5 from '../public/couplePhotos/coupleImg5.jpg';
import coupleImg6 from '../public/couplePhotos/coupleImg6.jpg';
import coupleImg7 from '../public/couplePhotos/coupleImg7.jpg';
import coupleImg8 from '../public/couplePhotos/coupleImg8.jpg';
import coupleImg9 from '../public/couplePhotos/coupleImg9.jpg';
import {CoupleGalleryImg} from '@/components'

const CoupleGallery = () => {
  return (
    <div className='max-w-[1240px] mx-auto text-center py-32'>
        <h1 className='textLibre text-2xl font-bold pb-2'>Galerie photo de couple</h1>
        <div className='grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 p-4'>
            <CoupleGalleryImg coupleImg={coupleImg1} />
            <CoupleGalleryImg coupleImg={coupleImg2} />
            <CoupleGalleryImg coupleImg={coupleImg3} />
            <CoupleGalleryImg coupleImg={coupleImg4} />
            <CoupleGalleryImg coupleImg={coupleImg5} />
            <CoupleGalleryImg coupleImg={coupleImg6} />
            <CoupleGalleryImg coupleImg={coupleImg7} />
            <CoupleGalleryImg coupleImg={coupleImg8} />
            <CoupleGalleryImg coupleImg={coupleImg9} />
        </div>
    </div>
  )
}

export default CoupleGallery