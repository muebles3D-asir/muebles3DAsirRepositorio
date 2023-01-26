import { InMemoryDbService } from 'angular-in-memory-web-api';

export class FurnitureData implements InMemoryDbService {
  createDb() {
    let furnitures = [
      {
        id: 0,
        title: 'First Product',
        price: 24.99,
        rating: 4.3,
        shortDescription: 'This is a short description of the First Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['electronics', 'hardware'],
        image: 'https://picsum.photos/820/300',
      },
      {
        id: 1,
        title: 'Second Product',
        price: 64.99,
        rating: 3.5,
        shortDescription: 'This is a short description of the Second Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['books'],
        image: 'https://picsum.photos/820/300',
      },
      {
        id: 2,
        title: 'Third Product',
        price: 74.99,
        rating: 4.2,
        shortDescription: 'This is a short description of the Third Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['electronics'],
        image: 'https://picsum.photos/820/300',
      },
      {
        id: 3,
        title: 'Fourth Product',
        price: 84.99,
        rating: 3.9,
        shortDescription: 'This is a short description of the Fourth Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['hardware'],
        image: 'https://picsum.photos/820/300',
      },
      {
        id: 4,
        title: 'Fifth Product',
        price: 94.99,
        rating: 5,
        shortDescription: 'This is a short description of the Fifth Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['electronics', 'hardware'],
        image: 'https://picsum.photos/820/300',
      },
      {
        id: 5,
        title: 'Sixth Product',
        price: 54.99,
        rating: 4.6,
        shortDescription: 'This is a short description of the Sixth Product',
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        categories: ['books'],
        image: 'https://picsum.photos/820/300',
      },
    ];
    return { furnitures: furnitures };
  }
}
